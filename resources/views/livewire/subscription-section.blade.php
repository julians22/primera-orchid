<section class="bg-gray-100 p-8 rounded-2xl text-center my-8">
    <h3 class="text-xl font-bold mb-2">Dapatkan Update Terbaru</h3>
    <p class="text-gray-600 text-sm mb-4">Berlangganan newsletter kami untuk info produk dan artikel terbaru.</p>
    
    <form wire:submit.prevent="subscribe" class="flex max-w-md mx-auto gap-2">
        <input type="email" placeholder="Email Anda..." class="flex-1 px-4 py-2 border rounded-lg focus:outline-none">
        <button type="submit" class="bg-black text-white px-6 py-2 rounded-lg font-medium">Subscribe</button>
    </form>
</section>