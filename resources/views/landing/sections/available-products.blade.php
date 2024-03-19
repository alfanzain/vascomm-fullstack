<div>
    <h2 class="font-serif text-2xl font-bold mb-[33px]">Produk Tersedia</h2>

    <div class="available-product-showcase grid grid-cols-5 gap-4">
    </div>
</div>

@push('scripts')
<script>
    fetch('/api/v1/products/available?take=5&skip=0&order=latest', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(async (response) => {
            const data = await response.json();
            const productList = document.querySelector('.available-product-showcase');

            data.data.forEach(product => {
                const card = document.createElement('div');
                card.className = 'bg-white border border-transparent hover:border-[#D6D6D6] p-4 cursor-pointer';

                const image = document.createElement('img');
                image.src = product.image
                    ? '{{ asset("images") }}/' + product.image
                    : '{{ asset("images") }}/no-image.png';
                image.className = 'w-auto rounded-md mb-4';
                card.appendChild(image);

                const name = document.createElement('h2');
                name.textContent = product.name;
                name.className = 'text-xl font-bold mb-2';
                card.appendChild(name);

                const price = document.createElement('p');
                price.textContent = `Rp ${product.price}`;
                price.className = 'text-gray-600 mb-2';
                card.appendChild(price);

                productList.appendChild(card);
            });
        })
        .catch(error => console.error('Error:', error));
</script>
@endpush