@extends('layouts.app')

{{-- Meta SEO Dinamis --}}
@section('meta_title', $meta['title'])
@section('meta_description', $meta['description'])

@section('content')

<section class="z-0 relative bg-soft-linen-50 w-full aspect-[20/6] overflow-y-hidden">
    <img src="{{ asset('img/contact-banner.png') }}" class="w-full h-full object-cover" alt="{{ __('contact.banner_alt') }}">
</section>

<section class="bg-white py-20 min-h-36">
    <div class="mx-auto container">

        {{-- Pesan Sukses / Error --}}
        @if (session('success'))
            <div class="mb-8 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contacts.store') }}" method="POST" class="w-full">
            @csrf

            <!-- Name -->
            <div class="mb-10">
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="{{ __('contact.form.name_placeholder') }}"
                    class="bg-transparent pb-2 border-everglade focus:border-form-teal border-b focus:outline-none w-full text-everglade text-sm transition-colors placeholder-form-placeholder"
                />
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Contact Number / Email -->
            <div class="gap-x-10 gap-y-10 grid grid-cols-1 sm:grid-cols-2 mb-10">
                <div>
                    <input
                        type="tel"
                        name="contact"
                        value="{{ old('contact') }}"
                        required
                        placeholder="{{ __('contact.form.contact_placeholder') }}"
                        class="bg-transparent pb-2 border-form-teal focus:border-form-teal border-b focus:outline-none w-full text-everglade text-sm transition-colors placeholder-form-placeholder"
                    />
                    @error('contact') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="{{ __('contact.form.email_placeholder') }}"
                        class="bg-transparent pb-2 border-form-teal focus:border-form-teal border-b focus:outline-none w-full text-everglade text-sm transition-colors placeholder-form-placeholder"
                    />
                    @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Message -->
            <div class="mb-6">
                <textarea
                    name="message"
                    required
                    placeholder="{{ __('contact.form.message_placeholder') }}"
                    rows="6"
                    class="bg-transparent border-b border-form-teal focus:outline-none w-full text-everglade text-sm resize-none placeholder-form-placeholder"
                >{{ old('message') }}</textarea>
                @error('message') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="group flex items-center space-x-4 px-6 py-3 border border-everglade rounded-full w-max text-everglade cursor-pointer">
                    <span class="font-semibold">{{ __('contact.form.submit_button') }}</span>
                    <span class="w-0 group-hover:w-14 transition-all duration-300 overflow-hidden">
                        <svg id="b" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.55 9.09">
                            <g id="c" data-name="Layer 1">
                                <path d="m28.01,0c.04,1.23.41,2.93,1.18,4.04H0v1h29.19c-.78,1.14-1.08,2.72-1.19,4.05,1.52-1.86,3.3-3.64,5.55-4.55-2.25-.94-4.11-2.62-5.55-4.54Z" style="fill: #113a3e;" />
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