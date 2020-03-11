@extends('layouts.home-layout')

@section('content')
<section class="intro-text">
  <div class="container container--small">
    <div class="intro-text__row">
      <div class="intro-text__col">
        <div class="intro-text__content">
          <h1><strong>Notify</strong> your employees via multiple channels.</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi bibendum et nulla non auctor. Duis libero velit, pulvinar sed mi porta, sagittis rhoncus felis. Suspendisse potenti. Suspendisse elementum eros metus, eget dapibus libero ultrices eu. Pellentesque sed elementum neque, id vestibulum nulla. Morbi vitae eros dui.</p>
        </div>
      </div>
      <div class="intro-text__col">
        <div class="intro-text__image">
          <img src="https://picsum.photos/600/350" alt="">
        </div>
      </div>
    </div>
  </div>
</section>

<section class="features">
  <div class="feature-bar">
    <div class="container container--small feature-bar__container">
      <h1 class="feature-bar__title">Development has <strong>now</strong> started!</h1>
      <h2 class="feature-bar__subtitle">What features can you expect?</h2>
    </div>
  </div>
  <div class="feature-content">
    <div class="container">
      <div class="feature-content__row">
        <div class="feature-content__col">
          <div class="feature-content__image">
            <img src="https://picsum.photos/600/350" alt="">
          </div>
        </div>
        <div class="feature-content__col">
          <div class="feature-content__content">
            <div class="feature-content__list-group">
              <ul class="feature-content__list">
                <li class="is-active">
                  <div>
                    <h3><i class="far fa-paper-plane"></i>Push Notifications</h3>
                    <div class="feature-content__list-label"><small>In progress</small></div>
                  </div>
                  <p>This feature is perfect if you quickly want to notify someone.</p>
                  <p><small>We expect to beta test soon.</small></p>
                </li>
                <li>
                  <div>
                    <h3>Email Notifications</h3>
                    <div class="feature-content__list-label"><small>Awaiting start development</small></div>
                  </div>
                  <p>This feature is perfect if you quickly want to notify someone.</p>
                </li>
                <li>
                  <div>
                    <h3>SMS Notifications</h3>
                    <div class="feature-content__list-label"><small>Awaiting start development</small></div>
                  </div>
                  <p>This feature is perfect if you quickly want to notify someone.</p>
                </li>
                <li>
                  <div>
                    <h3>WhatsApp Notifications</h3>
                    <div class="feature-content__list-label"><small>We expect to start this development in Q4 2020</small></div>
                  </div>
                  <p>This feature is perfect if you quickly want to notify someone.</p>
                  <p><small>We expect to start this development in Q4 2020</small></p>
                </li>
                <li>
                  <div>
                    <h3>Slack Notifications</h3>
                    <div class="feature-content__list-label"><small>We expect to start this development in Q4 2020</small></div>
                  </div>
                  <p>This feature is perfect if you quickly want to notify someone.</p>
                  <p><small>We expect to start this development in Q4 2020</small></p>
                </li>
              </ul>
            </div>
          </div>
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
                    <p>Aptent dolore edsafasdfasdfquadrum qui singularis te.</p>
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
                    <p>Commoveo gilvus iaceo nutus pagus tincidunt. Eligo Hallo? proprius saluto vulputate. Brevitas eligo et fere quadrum quae ratis.</p>
                    <p>Eum pecus quis. Accumsan genitus humo inhibeo ut vel. dev bene enim gemino ideo ille luptatum os veniam venio.</p>
                </div>
            </div>
        </div>
    </section>

  <!-- EIND CONTENT -->
  </div>
    <footer style="background: red;">test</footer>
@endsection
