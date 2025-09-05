<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Certificate Application Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #0072ff, #00c6ff);
      font-family: Arial, sans-serif;
      color: white;
      min-height: 100vh;
    }
    .container {
      margin-top: 50px;
      margin-bottom: 50px;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
    }
    .btn-custom {
      background: orange;
      border: none;
      color: white;
      font-weight: bold;
    }
    .btn-custom:hover {
      background: darkorange;
    }
    label span {
      color: red;
    }
    .error-msg {
      color: red;
      font-size: 0.9em;
      display: none;
    }
  </style>
</head>
<body>
  <div class="container text-center">
    <h1 class="mb-4">Jatiya Kabi Kazi Nazrul Islam University</h1>
    <h3 class="mb-5">Certificate & Transcript Application System</h3>

    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="card p-4 text-dark">
          <h4 class="mb-3 text-center">Apply Online</h4>
          <form id="applicationForm" action="submit.php" method="POST" enctype="multipart/form-data" novalidate>

            <div class="mb-3">
              <label class="form-label">Registration Number <span>*</span></label>
              <input type="text" name="registration_number" class="form-control">
              <div class="error-msg">Please enter your Registration Number</div>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Name <span>*</span></label>
              <input type="text" name="student_name" class="form-control">
              <div class="error-msg">Please enter your Name</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Student ID <span>*</span></label>
              <input type="text" name="student_id" class="form-control">
              <div class="error-msg">Please enter your Student ID</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Department <span>*</span></label>
              <input type="text" name="department" class="form-control">
              <div class="error-msg">Please enter your Department</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Email <span>*</span></label>
              <input type="email" name="email" class="form-control">
              <div class="error-msg">Please enter a valid Email</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Hall Clearance Number <span>*</span></label>
              <input type="text" name="hall_clearance_number" class="form-control">
              <div class="error-msg">Please enter Hall Clearance Number</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Medical Clearance Number <span>*</span></label>
              <input type="text" name="medical_clearance_number" class="form-control">
              <div class="error-msg">Please enter Medical Clearance Number</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Finance Clearance Number <span>*</span></label>
              <input type="text" name="finance_clearance" class="form-control">
              <div class="error-msg">Please enter Finance Clearance Number</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Document Type <span>*</span></label>
              <select name="document_type" class="form-control">
                <option value="">-- Select Document --</option>
                <option value="certificate">Certificate</option>
                <option value="transcript">Transcript</option>
              </select>
              <div class="error-msg">Please select Document Type</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Admit Card <span>*</span></label>
              <input type="file" name="admit_card" class="form-control">
              <div class="error-msg">Please upload your Admit Card</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Photo <span>*</span></label>
              <input type="file" name="photo" class="form-control">
              <div class="error-msg">Please upload your Photo</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Signature <span>*</span></label>
              <input type="file" name="signature" class="form-control">
              <div class="error-msg">Please upload your Signature</div>
            </div>

            <button type="submit" class="btn btn-custom w-100">Submit Application</button>
          </form>

          <div class="mt-3 text-center">
            <a href="home.php" class="btn btn-light">Back to Homepage</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const form = document.getElementById('applicationForm');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      let valid = true;

      const fields = [
        'registration_number','student_name','student_id','department','email',
        'hall_clearance_number','medical_clearance_number','finance_clearance',
        'document_type','admit_card','photo','signature'
      ];

      fields.forEach(function(name){
        const input = form[name];
        const errorDiv = input.nextElementSibling;
        if(!input.value){
          errorDiv.style.display = 'block';
          if(valid) input.focus();
          valid = false;
        } else {
          errorDiv.style.display = 'none';
        }
      });

      if(valid){
        form.submit();
      }
    });
  </script>
</body>
</html>



