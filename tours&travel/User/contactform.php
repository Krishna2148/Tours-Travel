
<div class="container px-5 my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="contact-card border-0 rounded-3 shadow" style="background-color:#CBE6EE;">
        <div class="card-body p-4">
          <div class="text-center">
            <div class="h2 fw-light" style="color:#348485">Get In Touch With Us</div>
            <h5 class="m-3">Reach us using form below</h5>
          </div>

          

          <form id="contactForm" method="POST" action = "./submitcontactmessage.php">

            <!-- Name Input -->
            <div class="form-floating mb-3">
              <input class="form-control" id="name"  name="name" type="text" placeholder="Name" required/>
            </div>

            <!-- Email Input -->
            <div class="form-floating mb-3">
              <input class="form-control" id="emailAddress" type="email" name="email" placeholder="Email Address" required/>
            </div>

            <!-- Message Input -->
            <div class="form-floating mb-3">
              <textarea class="form-control" id="message" type="text" name="message" placeholder="Message" style="height: 10rem;" required></textarea>
            </div>

            <!-- Submit button -->
            <div class="text-center">
              <button class="clickableBtn btn btn-lg " id="submitButton" type="submit" name="submit">Submit</button>
            </div>
          </form>
          <!-- End of contact form -->

        </div>
      </div>
    </div>
  </div>
</div>

