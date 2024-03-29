@extends('layouts.app')


@section('content')

<!-- Banner Area Starts -->
<section class="banner-area other-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Nous joindre!</h1>
                <a routerLink="/">Accueil</a>
            </div>
        </div>
    </div>
  </section>
  <!-- Banner Area End -->

    <!-- Map Area Starts -->
    <section class="map-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124595.81993757223!2d-8.066853679559559!3d12.607318459198535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe51cd1227450a91%3A0x8d6586b0257f07be!2sBamako%20Capital%20District!5e0!3m2!1sen!2sml!4v1663587482288!5m2!1sen!2sml" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- Map Area End -->


    <!-- Contact Form Starts -->
    <section class="contact-form section-padding3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <div class="d-flex">
                        <div class="into-icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="info-text">
                            <h3>Bamako, Mali</h3>
                            <p>Sotuba ACI</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="into-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="info-text">
                            <h3>+223 60 78 10 01</h3>
                            <p>Lundi-Vendredi 9h to 18h</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="into-icon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="info-text">
                            <h3>info@ekeneya.com</h3>
                            <p>Envoyez nous vos requêtes à tout moment!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <form action="#">
                        <div class="left">
                            <input class="form-group" type="text" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre nom complet'" required>
                            <input type="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre numéro de téléphone'" required>
                            <input type="text" placeholder="Enter subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Objet'" required>
                        </div>
                        <div class="right">
                            <textarea name="message" cols="20" rows="7"  placeholder="Enter Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Saisissez votre message'" required></textarea>
                        </div>
                        <button type="submit" class="template-btn">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form End -->

@endsection
