@extends('layout.user')
@section('title', 'Galeri Kegiatan')

@section('container')

    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 50vh">
            <div class="col-md-6">
                <div class="card-profile mb-3">
                    <img src="{{ asset('images/telkom1.jpeg') }}" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h1>SMK TELKOM JAKARTA</h1>
                        <p class="title">Jl. Daan Mogot KM.11, Cengkareng, Jakarta Barat</p>
                        <p>SMK Telkom Jakarta yang sebelumnya bernama SMK Telkom Sandhy Putra Jakarta sejak Maret 2014
                            berubah menjadi SMK Telkom Jakarta dengan dicanangkannya Telkom Schools oleh Telkom Foundation.
                        </p>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <p><button onclick="scrollToGallery()">Lihat Gallery Kegiatan</button></p>
                    </div>
                </div>
            </div>
        </div>

        <section id="Gallery" style="margin-bottom: 30vh">
            <h1 class="text-center">Galeri Kegiatan</h1>
            <div class="row">
                @foreach ($galeri as $item)
                    <div class="col-md-4">
                        <div class="card-profile mb-3">
                            <img src="{{ asset('images/galeri/' . $item->gambar) }}" class="card-img-top" alt="..."
                                style="height: 200px;" />
                            <div class="card-body">
                                <h2>{{ $item->nama }}</h2>
                                <p>
                                    <small class="text-muted">
                                        {{ $item->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p>{{ $item->text }}</p>
                                <div class="social-icons">
                                    <a href="#"><i class="fa fa-dribbble"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


    </div>
    <script>
        function scrollToGallery() {
            document.getElementById('Gallery').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
    <style>
        .card-profile {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .card-body {
            margin-bottom: 10%;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style>
@endsection
