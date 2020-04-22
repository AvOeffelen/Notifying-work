<header class="site-header">
  <div class="container site-header__container">
    <a href="#" class="site-header__logo">
      <strong>{{ config('app.name', 'Notifying.work') }}</strong>
    </a>
    <nav class="site-header__navbar" id="navbarSupportedContent">
      <ul>
          <li>
            <a href="#">Features</a>
          </li>
          <li>
            <a href="#">Pricing</a>
          </li>
          <li>
            <a href="#">Support</a>
          </li>
          <li>
            <a href="{{route('get.started.index')}}" class="btn btn--ghost-primary">Get started</a>
          </li>
      </ul>
    </nav>
  </div>
</header>

<!-- BEGIN CONTENT -->
<div class="content-area">
