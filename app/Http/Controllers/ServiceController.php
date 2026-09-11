<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {   
        $testimonials = Testimonial::where('is_active', true)->get();

        if ($testimonials->isEmpty()) {
            $testimonials = collect([
                [
                    'avatar'   => asset('img/customer-1.png'),
                    'name'     => 'Ayu Putri',
                    'location' => 'Surabaya, Indonesia',
                    'content'  => [
                        'en' => 'I am absolutely delighted with the orchids I received from Primera Orchids! The quality and freshness of the blooms exceeded my expectations. The arrangement was stunning, and it brought so much joy to my home. I highly recommend Primera Orchids for anyone looking for exquisite floral arrangements.',
                        'id' => 'Saya sangat senang dengan anggrek yang saya terima dari Primera Orchids! Kualitas dan kesegaran bunganya melebihi ekspektasi saya. Rangkaian bunganya sangat memukau dan membawa kebahagiaan di rumah saya.',
                    ],
                ],
                [
                    'avatar'   => asset('img/customer-1.png'),
                    'name'     => 'Bella Nabella',
                    'location' => 'Jakarta, Indonesia',
                    'content'  => [
                        'en' => 'Primera Orchids never disappoints! The orchids I ordered were delivered promptly and in perfect condition. The blooms were vibrant and long-lasting, and the arrangement was simply beautiful. I am extremely satisfied with my purchase and will definitely order again!',
                        'id' => 'Primera Orchids tidak pernah mengecewakan! Anggrek yang saya pesan dikirim dengan cepat dan dalam kondisi sempurna. Bunganya cerah dan tahan lama, serta rangkaian bunganya sangat indah.',
                    ],
                ],
            ]);
        }

        $services = Service::with('items')->get();
        return view('pages.services', compact('services', 'testimonials'));
    }
}
