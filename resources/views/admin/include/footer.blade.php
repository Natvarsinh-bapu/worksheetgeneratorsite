<footer>
    <div class="container-fluid">
    <p class="copyright">&copy; {{ \Carbon\Carbon::now()->format('Y') }} <a href="{{ url('/') }}" target="_blank">{{ env('APP_NAME') }}</a>. All Rights Reserved.</p>
    </div>
</footer>