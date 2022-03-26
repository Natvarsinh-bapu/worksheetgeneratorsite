<div>
    <h3>Name: {{ $user->name }}</h3>
</div>
<div>
    <h3>Enrollment No.: {{ $user->enrollment_no }}</h3>
</div>
<div>
    <h3>Email: {{ $user->email }}</h3>
</div>
<div>
    <h3>Phone: {{ $user->phone }}</h3>
</div>
<div>
    <h3>Class: {{ $user->className->name }}</h3>
</div>
<div>
    <h3>Institute: {{ $user->institute->name }}</h3>
</div>