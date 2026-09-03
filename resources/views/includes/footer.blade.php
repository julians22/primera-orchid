<footer class="bg-everglade pt-16 pb-14">

    <div class="flex lg:flex-row flex-col justify-between mx-auto container">
        <div class="flex flex-col gap-4 lg:max-w-1/3">
            <img src="{{ asset('img/logo-persegi.png') }}" alt="" width="230">
            <p class="text-white"><strong>#1 INDONESIAN MINI ORCHIDS IN A BOX</strong></p>

            <ul class="space-y-4 py-4 border-white border-t border-b">
                <li class="flex gap-3">
                    <x-simpleline-location-pin class="fill-white outline-white size-6"/>
                    <div>
                        <a target="_blank" href="https://maps.app.goo.gl/ABCpDdgJFXedJHVn8" class="text-white :underline">Jl. Polisi Istimewa No.1 C <br> Keputran, Kec. Tegalsari, Surabaya, Jawa Timur 60265</a>
                    </div>
                </li>
                <li class="flex gap-3">
                    <x-si-whatsapp class="fill-white outline-white size-5"/>
                    <div>
                        <a
                            target="_blank"
                            href="{{ whatsapp_link('6280818978781') }}" class="text-white">0818 978 781</a>
                    </div>
                </li>
            </ul>
        </div>


        <div class="flex flex-col gap-8 lg:max-w-1/3">
            <p class="font-bold text-white text-lg">Get a first peek at new products, special offers, and so much more</p>

            <form action="#" class="inline-flex gap-4">
                <input type="text" class="bg-white px-3 py-1.5 rounded-full focus:outline-none" placeholder="Email Address">
                <button type="submit" class="px-3 py-1.5 border border-white rounded-full text-white">Sign up</button>
            </form>
            <ul class="gap-4 grid grid-cols-3">
                <li><a href="#" class="font-semibold text-white">About Us</a></li>
                <li><a href="#" class="font-semibold text-white">Products</a></li>
                <li><a href="#" class="font-semibold text-white">Articles</a></li>
                <li><a href="#" class="font-semibold text-white">Subscription</a></li>
                <li><a href="#" class="font-semibold text-white">Contact</a></li>
                <li><a href="#" class="font-semibold text-white">Shop</a></li>
            </ul>
        </div>


    </div>


</footer>
