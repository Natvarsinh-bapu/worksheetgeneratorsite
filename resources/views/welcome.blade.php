@extends('user.layouts.main')

@section('content')
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
          <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
              <h1>Download worksheets</h1>
              <h2>Download worksheets of your school & others extra worksheets from our sides</h2>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img">
              <img src="{{ asset('front_theme/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
          </div>
        </div>
    </div>
  </section>
  <main id="main">
    <section id="about" class="about">
        <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6">
                <img src="{{ asset('front_theme/assets/img/about.png') }}" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6 pt-4 pt-lg-0 content">
                <div>
                    <h3>Download worksheets</h3>
                    <p class="font-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                        <li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute</li>
                    </ul>
                </div>
              </div>
          </div>
        </div>
    </section>
    <section id="about2" class="about">
        <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6 pt-4 pt-lg-0 content">
                <h3>Download worksheets</h3>
                <p class="font-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.
                </p>
                <ul>
                    <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                    <li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
                    <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute</li>
                </ul>
              </div>
              <div class="col-lg-6">
                <img src="{{ asset('front_theme/assets/img/about.png') }}" class="img-fluid" alt="">
              </div>
          </div>
        </div>
    </section>
    <section id="featured-services" class="featured-services">
        <div class="container">
          <div class="row">
              <div class="col-lg-4 col-md-6">
                <div class="icon-box">
                    <div class="icon"><i class="icofont-computer"></i></div>
                    <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                    <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                <div class="icon-box">
                    <div class="icon"><i class="icofont-image"></i></div>
                    <h4 class="title"><a href="">Dolor Sitema</a></h4>
                    <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                <div class="icon-box">
                    <div class="icon"><i class="icofont-tasks-alt"></i></div>
                    <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
                    <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
                </div>
              </div>
          </div>
        </div>
    </section>
  </main>
@endsection