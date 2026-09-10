<section
    class="bg-white py-8 lg:py-20 min-h-36">

    <!-- Section Title Desktop -->
    <div x-intersect:enter.half="shown = true" x-intersect:leave.half="shown = false" x-data="{ shown: false }">
        <h3 class="hidden lg:flex flex-col items-center gap-4">
            <span class="text-2xl"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >LOVED BY</span>
            <span class="font-serif font-semibold text-everglade text-5xl italic"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >OUR CUSTOMERS</span>
        </h3>
    </div>

    <!-- Section Title Mobile -->
    <div x-intersect:enter="shown = true" x-intersect:leave="shown = false" x-data="{ shown: false }">
        <h3 class="lg:hidden flex flex-col items-center gap-4 text-center">
            <span class="text-2xl"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >LOVED BY</span>
            <span class="font-serif font-semibold text-everglade text-5xl italic"
                :class="shown ? 'animate-up-in' : 'animate-up-out'"
                >OUR CUSTOMERS</span>
        </h3>
    </div>


    <div class="mx-auto pt-10 lg:pt-20 container">

        <div class="flex lg:flex-row flex-col justify-center gap-4">

            <div class="relative flex lg:flex-row flex-col bg-soft-linen-100 px-4 pt-4 lg:pt-16 pb-4 rounded-2xl max-w-2xl">
                <div class="lg:-top-16 lg:left-1/2 lg:absolute lg:inset-x-0 mx-auto lg:mx-0 rounded-full w-32 h-32 overflow-hidden lg:-translate-x-1/2">
                    <img src="{{ asset('img/customer-1.png') }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col items-center">
                    <!-- Name -->
                    <p class="font-bold text-everglade text-xl">Ayu Putri</p>
                    <!-- Region -->
                    <p class="mb-6 text-everglade text-sm"><i>Surabaya, Indonesia</i></p>
                    <!-- Testimonial -->
                    <p class="text-everglade text-lg">"I am absolutely delighted with the orchids I received from Primera Orchids! The quality and freshness of the blooms exceeded my expectations. The arrangement was stunning, and it brought so much joy to my home. I highly recommend Primera Orchids for anyone looking for exquisite floral arrangements."</p>
                </div>
            </div>

            <div class="relative flex lg:flex-row flex-col bg-soft-linen-100 px-4 pt-4 lg:pt-16 pb-4 rounded-2xl max-w-2xl">
                <div class="lg:-top-16 lg:left-1/2 lg:absolute lg:inset-x-0 mx-auto lg:mx-0 rounded-full w-32 h-32 overflow-hidden lg:-translate-x-1/2">
                    <img src="{{ asset('img/customer-1.png') }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col items-center">
                    <!-- Name -->
                    <p class="font-bold text-everglade text-xl">Bella Nabella</p>
                    <!-- Region -->
                    <p class="mb-6 text-everglade text-sm"><i>Jakarta, Indonesia</i></p>
                    <!-- Testimonial -->
                    <p class="text-everglade text-lg">"Primera Orchids never disappoints! The orchids I ordered were delivered promptly and in perfect condition. The blooms were vibrant and long-lasting, and the arrangement was simply beautiful. I am extremely satisfied with my purchase and will definitely order again!"</p>
                </div>
            </div>



        </div>


    </div>

</section>