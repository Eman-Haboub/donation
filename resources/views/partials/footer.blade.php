<footer>
    <div class="container">
        <div class="row text-start">
            <div class="col-md-4">
                <h6>Quick links</h6>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li> <a class="nav-link {{ request()->routeIs('about') }}" href="{{ route('about') }}">About us</a>
                    </li>
                    <li><a class="nav-link {{ request()->routeIs('about') }}" href="{{ route('about') }}">Get
                            Accredited</a></li>
                      <li>
                    <a class="nav-link {{ request()->routeIs('families.index') ? 'active' : '' }}"
                        href="{{ route('families.index') }}">Our Causes</a>
                </li>
                    <li><a class="nav-link {{ request()->routeIs('gallery') }}" href="{{ route('gallery') }}">Gallery</a></li>

                </ul>
            </div>
            <div class="col-md-4">
                <h6>Contact us</h6>
                <ul>
                    <li>123 Gaza Street, Gaza City
                        Gaza 84020</li>
                    <li>GazaHelpHub@example.com</li>
                    <li>+970593349470</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Urgent Causes</h6>
                <div class="cause-item">
                    <img src="{{ asset('storage/Education.webp') }}" class="cause-img" alt="Education">

                    <div>
                        <strong>Education</strong>
                        <div class="progress">
                            <div class="progress-bar" style="width: 53%"></div>
                        </div>
                    </div>
                </div>
                <div class="cause-item">
                    <img src="{{ asset('storage/Health.jpg') }}" class="cause-img" alt="Health">
                    <div>
                        <strong>Health</strong>
                        <div class="progress">
                            <div class="progress-bar" style="width: 58%"></div>
                        </div>
                    </div>
                </div>
                <div class="cause-item">
                    <img src="{{ asset('storage/Human rights.webp') }}" class="cause-img" alt="Human Rights">
                    <div>
                        <strong>Human rights</strong>
                        <div class="progress">
                            <div class="progress-bar" style="width: 53%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>




<div class="footer-bottom">
    <div>
        <span><a href="{{ route('privacy') }}">Privacy & Policy</a></span> |
        <span>Terms & Conditions</span>
    </div>
    <div>© 2025 copyright all right reserved</div>
    <div class="social-icons">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-twitter"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-youtube"></i></a>
    </div>
</div>
