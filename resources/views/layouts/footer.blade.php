<footer class="main-footer">
    {{-- To the right --}}
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0
    </div>
    {{-- Default to the left --}}
    <strong>Copyright &copy; 2022-2023 <a href="https://murabba.com/">Murabba</a>.</strong> All rights reserved.
  </footer>
</div>
{{-- ./wrapper --}}

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>