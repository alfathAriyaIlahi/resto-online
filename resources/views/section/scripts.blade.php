<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
  let cart = [];

  window.toggleCart = function() {
    document.getElementById('cart-modal').classList.toggle('hidden');
  }

  window.addToCart = function(id, name, price, img) {
    const productCard = document.querySelector(`.product-card[data-id="${id}"]`);

    let options = [];
    try {
      options = JSON.parse(productCard.getAttribute('data-options') || '[]');
    } catch (e) {
      console.error("Error parsing options", e);
    }

    if (options && options.length > 0) {
      showOptionModal(id, name, price, img, options);
    } else {
      const cartId = `prod-${id}`;
      const item = cart.find(i => i.cartId === cartId);

      if (item) {
        item.jumlah++;
      } else {
        cart.push({ cartId, id, name, price, img, jumlah: 1 });
      }

      renderCart();
    }
  }

  function showOptionModal(id, name, price, img, options) {
    const modal = document.getElementById('option-modal');
    const container = document.getElementById('option-container');

    document.getElementById('modal-product-name').innerText = name;
    container.innerHTML = '';

    const groups = options.reduce((acc, opt) => {
      (acc[opt.jenis] = acc[opt.jenis] || []).push(opt);
      return acc;
    }, {});

    for (const [jenis, items] of Object.entries(groups)) {
      let html = `<div class="mb-5 text-left">
        <h4 class="text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">${jenis}</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">`;

      items.forEach(item => {
        html += `
          <label class="cursor-pointer group">
            <input type="${jenis === 'size' ? 'radio' : 'checkbox'}"
                   name="${jenis}"
                   value="${item.id}"
                   data-nama="${item.nama_opsi}"
                   data-harga="${item.harga_tambahan}"
                   class="peer hidden" ${jenis === 'size' ? 'required' : ''}>
            <div class="p-4 border border-gray-100 rounded-2xl text-sm font-bold transition peer-checked:border-orange-600 peer-checked:bg-orange-50 group-hover:bg-gray-50">
              <div class="flex justify-between items-center">
                <span>${item.nama_opsi}</span>
                <span class="text-orange-600 text-[10px]">+Rp ${parseInt(item.harga_tambahan).toLocaleString('id-ID')}</span>
              </div>
            </div>
          </label>`;
      });

      html += `</div></div>`;
      container.innerHTML += html;
    }

    document.getElementById('confirm-option-btn').onclick = () => finalizeAddToCart(id, name, price, img);
    modal.classList.remove('hidden');
  }

  function finalizeAddToCart(id, name, price, img) {
    const selected = [];
    let extraPrice = 0;

    const inputs = document.querySelectorAll('#option-container input:checked');

    const hasSize = document.querySelector('#option-container input[name="size"]');
    const sizeSelected = document.querySelector('#option-container input[name="size"]:checked');

    if (hasSize && !sizeSelected) {
      alert("Silakan pilih ukuran terlebih dahulu!");
      return;
    }

    inputs.forEach(input => {
      selected.push(input.getAttribute('data-nama'));
      extraPrice += parseFloat(input.getAttribute('data-harga'));
    });

    const finalPrice = price + extraPrice;
    const optionString = selected.join(', ');
    const cartId = `prod-${id}-${selected.sort().join('-')}`;

    const item = cart.find(i => i.cartId === cartId);

    if (item) {
      item.jumlah++;
    } else {
      cart.push({
        cartId,
        id,
        name: name + (optionString ? ` [${optionString}]` : ''),
        price: finalPrice,
        img,
        jumlah: 1
      });
    }

    document.getElementById('option-modal').classList.add('hidden');
    renderCart();
  }

  window.updateQty = function(id, delta) {
    const item = cart.find(i => i.cartId === id);

    if (item) {
      item.jumlah += delta;

      if (item.jumlah < 1) {
        cart = cart.filter(i => i.cartId !== id);
      }
    }

    renderCart();
  }

  window.toggleAlamat = function(show) {
    const container = document.getElementById('alamat-container');
    const input = document.getElementById('input_alamat');

    if (show) {
      container.classList.remove('hidden');
      input.setAttribute('required', 'true');
    } else {
      container.classList.add('hidden');
      input.removeAttribute('required');
      input.value = '';
    }
  }

  window.cekPromo = function() {
    const kodeInput = document.getElementById('input_promo');
    const kode = kodeInput.value.toUpperCase();
    const totalAsli = cart.reduce((sum, item) => sum + (item.price * item.jumlah), 0);
    const msg = document.getElementById('promo-msg');

    if (!kode) return alert("Masukkan kode promo!");
    if (totalAsli <= 0) return alert("Keranjang masih kosong!");

    fetch('/cek-kupon', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        kode: kode,
        total_belanja: totalAsli
      })
    })
    .then(res => res.json())
    .then(data => {
      msg.classList.remove('hidden');

      if (data.valid) {
        let diskon = data.nilai;

        if (data.jenis === 'persen') {
          diskon = (totalAsli * data.nilai) / 100;
        }

        let totalBaru = totalAsli - diskon;

        document.getElementById('total-harga-display').innerText = 'Rp ' + totalBaru.toLocaleString('id-ID');
        document.getElementById('total-harga-input').value = totalBaru;

        msg.innerText = data.message + " (Potongan: Rp " + diskon.toLocaleString('id-ID') + ")";
        msg.className = 'text-[10px] mt-1 font-medium text-green-600';

        kodeInput.readOnly = true;
      } else {
        msg.innerText = data.message;
        msg.className = 'text-[10px] mt-1 font-medium text-red-500';
      }
    })
    .catch(() => alert("Terjadi kesalahan sistem saat cek kupon."));
  }

  function renderCart() {
    const cartList = document.getElementById('cart-list');
    const cartEmpty = document.getElementById('cart-empty');
    const cartFooter = document.getElementById('cart-footer');
    const cartCount = document.getElementById('cart-count');
    const hiddenInputs = document.getElementById('hidden-inputs');

    let total = 0;
    let count = 0;

    cartList.innerHTML = '';
    hiddenInputs.innerHTML = '';

    cart.forEach((item, index) => {
      total += (item.price * item.jumlah);
      count += item.jumlah;

      cartList.innerHTML += `
        <li class="flex items-center gap-4 py-2 border-b border-gray-50 text-left">
          <img src="${item.img}" class="size-16 rounded-xl object-cover shadow-sm">

          <div class="flex-1">
            <h3 class="font-bold text-gray-900 text-sm leading-tight">${item.name}</h3>
            <p class="text-xs text-orange-600 font-semibold mt-1">Rp ${item.price.toLocaleString('id-ID')}</p>
          </div>

          <div class="flex items-center gap-2">
            <button type="button" onclick="updateQty('${item.cartId}', -1)" class="size-7 rounded-full border border-gray-200 hover:bg-gray-100">-</button>
            <span class="font-bold text-sm">${item.jumlah}</span>
            <button type="button" onclick="updateQty('${item.cartId}', 1)" class="size-7 rounded-full border border-orange-200 text-orange-600 hover:bg-orange-50">+</button>
          </div>
        </li>`;

      hiddenInputs.innerHTML += `
        <input type="hidden" name="items[${index}][produk_id]" value="${item.id}">
        <input type="hidden" name="items[${index}][nama_produk]" value="${item.name}">
        <input type="hidden" name="items[${index}][jumlah]" value="${item.jumlah}">
        <input type="hidden" name="items[${index}][subtotal]" value="${item.price * item.jumlah}">`;
    });

    cartCount.innerText = count;

    document.getElementById('total-harga-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('total-harga-input').value = total;

    const inputPromo = document.getElementById('input_promo');
    const msgPromo = document.getElementById('promo-msg');

    if (inputPromo.readOnly) {
      inputPromo.readOnly = false;
      inputPromo.value = '';
      msgPromo.classList.add('hidden');
    }

    if (cart.length > 0) {
      cartList.classList.remove('hidden');
      cartFooter.classList.remove('hidden');
      cartEmpty.classList.add('hidden');
    } else {
      cartList.classList.add('hidden');
      cartFooter.classList.add('hidden');
      cartEmpty.classList.remove('hidden');
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('btn-konfirmasi');

    if (btn) {
      btn.onclick = function(e) {
        e.preventDefault();

        const total = document.getElementById('total-harga-input').value;

        if (total <= 0) return alert("Keranjang masih kosong!");

        btn.innerText = "Memproses...";
        btn.disabled = true;

        const form = document.getElementById('form-pesanan');
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        data.items = cart;

        fetch('/pesan', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(resData => {
          btn.innerText = "Konfirmasi & Bayar Sekarang";
          btn.disabled = false;

          if (resData.snap_token) {
            window.snap.pay(resData.snap_token, {
              onSuccess: function() {
                window.location.href = '/dashboard';
              },
              onPending: function() {
                window.location.reload();
              }
            });
          } else {
            alert("Gagal mendapatkan kode pembayaran. Cek log server.");
          }
        })
        .catch(err => {
          btn.innerText = "Konfirmasi & Bayar Sekarang";
          btn.disabled = false;

          alert("Terjadi error. Pastikan Controller mereturn JSON.");
          console.error(err);
        });
      };
    }
  });
</script>

<style>
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0.95);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .animate-fadeIn {
    animation: fadeIn 0.2s ease-out forwards;
  }

  [x-cloak] {
    display: none !important;
  }
</style>