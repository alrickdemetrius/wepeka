@extends('layouts.app')

@section('styles')
    <style>
        .faq-header {
            background: linear-gradient(to right, var(--hunter-green), var(--fern-green));
            padding: 4rem 0 2rem;
            margin-bottom: 3rem;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            text-align: center;
            color: white;
        }

        .faq-header h1 {
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .faq-header .lead {
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        .faq-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .faq-section h2 {
            margin-bottom: 2rem;
            color: var(--brunswick-green);
            position: relative;
            display: inline-block;
        }

        .faq-section h2:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background-color: var(--sage);
            bottom: -10px;
            left: 25%;
        }

        .accordion {
            max-width: 800px;
            margin: 0 auto 4rem;
        }

        .accordion-item {
            margin-bottom: 1rem;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .accordion-button {
            background-color: white;
            color: var(--brunswick-green);
            font-weight: 600;
            padding: 1.2rem 1.5rem;
            border: none;
            border-radius: 10px !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--fern-green);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, 0.125);
        }

        .accordion-button::after {
            background-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .accordion-body {
            background-color: white;
            padding: 1.5rem;
            line-height: 1.7;
            color: #555;
        }



        .faq-contact {
            background-color: rgba(163, 177, 138, 0.1);
            padding: 3rem 0;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .faq-contact h3 {
            color: var(--brunswick-green);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .faq-contact p {
            max-width: 600px;
            margin: 0 auto 1.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="bg-light min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <!-- Title -->
            <div class="faq-section">
                <h2>Frequently Asked Questions</h2>
            </div>

            <!-- FAQ-->
            <div class="accordion" id="faqAccordion">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Question?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Minus, cumque adipisci nesciunt ipsa impedit pariatur consequuntur fugiat magni quibusdam
                            sapiente.
                            Facere minima odit dicta? Recusandae autem assumenda vel cupiditate corrupti.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq2">
                            Question?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Minus, cumque adipisci nesciunt ipsa impedit pariatur consequuntur fugiat magni quibusdam
                            sapiente.
                            Facere minima odit dicta? Recusandae autem assumenda vel cupiditate corrupti.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq3">
                            Question?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Minus, cumque adipisci nesciunt ipsa impedit pariatur consequuntur fugiat magni quibusdam
                            sapiente.
                            Facere minima odit dicta? Recusandae autem assumenda vel cupiditate corrupti.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq4">
                            Question?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Minus, cumque adipisci nesciunt ipsa impedit pariatur consequuntur fugiat magni quibusdam
                            sapiente.
                            Facere minima odit dicta? Recusandae autem assumenda vel cupiditate corrupti.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection