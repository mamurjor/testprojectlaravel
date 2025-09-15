<footer class="section-sm">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <img src="https://dummyimage.com/48x48/0ea5a0/ffffff.png&text=BD" alt="" width="36"
                        height="36">
                    <strong>BDCL</strong>
                </div>
                <p class="small">Bangladesh Doctors Club Ltd — building a stronger healthcare community since 2016.</p>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="text-white">Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="#about">About</a></li>
                    <li><a href="#members">Members</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="text-white">Resources</h6>
                <ul class="list-unstyled small">
                    <li><a href="#news">News</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white">Newsletter</h6>

                <form id="newsletter-form" class="d-flex gap-2 needs-validation" novalidate>
                    @csrf
                    <input type="email" name="email" id="newsletter-email" class="form-control"
                        placeholder="Email address" required>
                    <button class="btn btn-brand" id="newsletter-submit" type="submit">Join</button>
                    <div class="invalid-feedback">Valid email required</div>
                </form>

                <div id="newsletter-feedback" class="small mt-2 text-white-50" style="display:none;"></div>
            </div>
        </div>
        <hr class="border-secondary-subtle my-4">
        <div class="d-flex flex-column flex-sm-row justify-content-between small">
            <div>© <span id="y"></span> BDCL. All rights reserved.</div>
            <div class="d-flex gap-3">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms</a>
            </div>
        </div>
    </div>
</footer>
