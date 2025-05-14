<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Student Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .success-message {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    
    <h2 class="text-center mb-4">Create Student Record</h2>
    <form id="studentForm">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter full name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" required>
        </div>
        <div class="mb-3">
            <label for="number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="number" placeholder="Enter phone number" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" placeholder="Enter address" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
    <div class="alert alert-success mt-3 success-message" role="alert">
        Student data submitted successfully!
    </div>
    <div class="alert alert-danger mt-3 error-message d-none" role="alert">
        Failed to submit student data.
    </div>
</div>

<script>
    document.getElementById('studentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const data = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            number: document.getElementById('number').value,
            address: document.getElementById('address').value
        };

        fetch('http://localhost:8080/api/students', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(async response => {
            if (response.ok) {
                document.querySelector('.success-message').style.display = 'block';
                document.querySelector('.error-message').classList.add('d-none');
                document.getElementById('studentForm').reset();
            } else {
                throw new Error('Request failed');
            }
        })
        .catch(error => {
            document.querySelector('.error-message').classList.remove('d-none');
            document.querySelector('.success-message').style.display = 'none';
            console.error('Error:', error);
        });
    });
</script>

</body>
</html>
