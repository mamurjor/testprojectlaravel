<!DOCTYPE html>
<html>

<body>
    <h2>{{ $notice->title }}</h2>
    <p>{!! nl2br(e($notice->body)) !!}</p>
    <hr>
    <p style="font-size:12px;color:#777;">You’re receiving this because you subscribed to our newsletter.</p>
</body>

</html>
