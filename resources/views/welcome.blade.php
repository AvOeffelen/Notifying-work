@extends('layouts.home-layout')

@section('content')
    <section class="features">
        <div class="row feature-bar">
            <div class="col-md-12">
                <div class=" text-center">
                    <h1 class="feature-title display-3">Development has now started!</h1>
                    <h2 class="text-white">What features can you expect?</h2>
                </div>
            </div>
        </div>
        <div class="row padding-row-15 pr-5">
            <div class="col-md-5 pt-5">
                <div class="text-center header-image">
                    <img src="https://picsum.photos/450/350">
                </div>
            </div>
            <div class="col-md-7">
                <div class="list-group">
                    <div class="list-group-item  flex-column align-items-start feature-inprogress text-white">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Push Notifications</h5>
                            <small>In progress</small>
                        </div>
                        <p class="mb-1">This feature is perfect if you quickly want to notify someone.</p>
                        <small>We expect to beta test soon.</small>
                    </div>
                    <div class="list-group-item flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Email Notifications</h5>
                            <small>Awaiting start development</small>
                        </div>
                        <p class="mb-1">This feature is perfect if you quickly want to notify someone.</p>
                    </div>
                    <div class="list-group-item flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">SMS Notifications</h5>
                            <small>Awaiting start development</small>
                        </div>
                        <p class="mb-1">This feature is perfect if you quickly want to notify someone.</p>
                    </div>
                    <div class="list-group-item flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">WhatsApp Notifications</h5>
                            <small>We expect to start this development in Q4 2020</small>
                        </div>
                        <p class="mb-1">This feature is perfect if you quickly want to notify someone.</p>
                        <small>We expect to start this development in Q4 2020</small>
                    </div>
                    <div class="list-group-item flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Slack Notifications</h5>
                            <small>We expect to start this development in Q4 2020</small>
                        </div>
                        <p class="mb-1">This feature is perfect if you quickly want to notify someone.</p>
                        <small>We expect to start this development in Q4 2020</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row padding-row-15 p-5">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="display-5">Testimonials</h1>
                    <h1 class="display-3"><b>We can say it's great</b></h1>
                    <h3>Let's see what our users say about <span class="notifying-work">Notifyin.work</span></h3>
                    <small>These users are alpha testers. They had exclusive access to the first features.</small>
                </div>
            </div>
        </div>
        <div class="row padding-row-15 p-5 justify-content-center">
            <div class="row mb-5">
                <div class="col-md-6 order-md-2">
                    <img src="https://picsum.photos/275/275" alt="Personal Trainer 1" class="img-fluid border-white border-w-5 w-50 w-md-80 w-lg-60 rounded-circle">
                </div>
                <div class="col-md-6 flex-valign text-md-right">
                    <h3 class="text-uppercase text-letter-spacing-xs mt-0 mb-1 notifying-work">
                        John Doe
                    </h3>
                    <h5 class="my-0 font-weight-normal">
                        <em>Function</em>
                    </h5>
                    <hr class="hr-primary w-70 ml-0 ml-md-auto mr-md-0 mb-3">
                    <p>Aptent dolore enim facilisi humo magna melior nisl occuro. Ad os sed utinam. Accumsan autem brevitas esse exerci ludus ratis.</p>
                    <p>Adipiscing nimis sed tego turpis. Abico wtf? quadrum qui singularis te.</p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6 text-md-right">
                    <img src="https://picsum.photos/275/275" alt="Personal Trainer 2" class="img-fluid border-white border-w-5 w-50 w-md-80 w-lg-60 rounded-circle">
                </div>
                <div class="col-md-6 flex-valign">
                    <h3 class="text-uppercase text-letter-spacing-xs mt-0 mb-1 notifying-work">
                        Kim Kirk
                    </h3>
                    <h5 class="my-0 font-weight-normal">
                        <em>Professional napper</em>
                    </h5>
                    <hr class="hr-primary w-70 ml-0 mb-3">
                    <p>Commoveo gilvus iaceo nutus pagus tincidunt. Eligo nutus proprius saluto vulputate. Brevitas eligo et fere quadrum quae ratis.</p>
                    <p>Eum pecus quis. Accumsan genitus humo inhibeo ut vel. Augue bene enim gemino ideo ille luptatum os veniam venio.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
