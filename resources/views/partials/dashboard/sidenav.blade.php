<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
    </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-comment-alt"></i>
                <span>Notifications</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{route('notification.push')}}">Push Notification</a>
                <button class="dropdown-item" href="#" disabled>Email</button>
                <button class="dropdown-item" href="#" disabled>SMS</button>
                <button class="dropdown-item" href="#" disabled>WhatsApp</button>
                <button class="dropdown-item" href="#" disabled>Slack</button>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Notification Settings</h6>
                <a class="dropdown-item" href="#">Push Settings</a>
                <button class="dropdown-item" href="#" disabled>Email Settings</button>
                <button class="dropdown-item" href="#" disabled>SMS Settings</button>
                <button class="dropdown-item" href="#" disabled>WhatsApp Settings</button>
                <button class="dropdown-item" href="#" disabled>Slack Settings</button>
                <div class="dropdown-divider"></div>
                <button class="dropdown-item" href="#" disabled>Notification queue</button>
            </div>
        </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('employees')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Employees</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('my.company')}}">
            <i class="fas fa-fw fa-building"></i>
            <span>My company</span></a>

    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Settings</span></a>
    </li>

</ul>
