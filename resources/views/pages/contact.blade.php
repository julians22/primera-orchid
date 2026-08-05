@extends('layouts.app')

@section('content')

<section class="z-0 relative bg-soft-linen-50 w-full aspect-[20/6] overflow-y-hidden">

    <img src="{{ asset('img/contact-banner.png') }}" class="w-full h-full object-cover" alt="">

</section>

<section class="bg-white py-20 min-h-36">


    <div class="mx-auto container">
        <form class="w-full">
            <!-- Name -->
            <div class="mb-10">
                <input
                    type="text"
                    name="name"
                    placeholder="What's Your Name"
                    class="bg-transparent pb-2 border-evertext-everglade focus:border-form-teal border-b focus:outline-none w-full text-everglade text-sm transition-colors placeholder-form-placeholder"
                />
            </div>

            <!-- Contact Number / Email -->
            <div class="gap-x-10 gap-y-10 grid grid-cols-1 sm:grid-cols-2 mb-10">
                <input
                    type="tel"
                    name="contact"
                    placeholder="Your Contact Number"
                    class="bg-transparent pb-2 border-form-teal focus:border-form-teal border-b focus:outline-none w-full text-everglade text-sm transition-colors placeholder-form-placeholder"
                />
                <input
                    type="email"
                    name="email"
                    placeholder="Your Email"
                    class="bg-transparent pb-2 border-form-teal focus:border-form-teal border-b focus:outline-none w-full text-everglade text-sm transition-colors placeholder-form-placeholder"
                />
            </div>

            <!-- Message -->
            <div class="mb-6">
                <textarea
                    name="message"
                    placeholder="Type your message here"
                    rows="6"
                    class="bg-transparent focus:outline-none w-full text-everglade text-sm resize-none placeholder-form-placeholder"
                ></textarea>
            </div>

            <!-- Bottom line + submit -->
            <div class="flex justify-end pt-6 border-form-teal border-t">

                <button type="submit" class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade cursor-pointer">
                    <span class="font-semibold">Submit</span>
                    <span class="w-0 group-hover:w-14 transition-all duration-300">
                        <?xml version="1.0" encoding="UTF-8"?>
                        <svg id="b" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 33.55 9.09">
                            <g id="c" data-name="Layer 1">
                                <path
                                    d="m28.01,0c.04,1.23.41,2.93,1.18,4.04H0v1h29.19c-.78,1.14-1.08,2.72-1.19,4.05,1.52-1.86,3.3-3.64,5.55-4.55-2.25-.94-4.11-2.62-5.55-4.54Z"
                                    style="fill: #113a3e;" />
                            </g>
                        </svg>
                    </span>
                </button>
            </div>

        </form>
    </div>


</section>

<x-subcribe-hero/>

@endsection
