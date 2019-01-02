<!-- footer start -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 copy-right">
                <p class="footer-text">
                 &copy;&nbsp;2018 - <a href="#" target="_blank">Arizona National Software</a>&nbsp;-&nbsp;
                 <a href="#" target="_blank">Terms &amp; Conditions</a>&nbsp;|&nbsp;
                 <a href="#" target="_blank">Privacy Policy</a>&nbsp;|&nbsp;
                 <a href="#" target="_blank">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- jQuery -->
<script src="{{ url('/admin/js/jquery.min.js') }}"></script>
<script src="{{ url('/admin/js/bootstrap.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function(){
        $( ".date" ).datepicker();
    });

    $( ".fa-refresh" ).click(function() {
          $("#search").val('');
          location.reload();
});
</script>
<script>
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script src="{{ url('/admin/js/popper.min.js') }}"></script>
<script src="{{ url('/admin/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ url('/admin/js/custom.js') }}"></script>
<script src="{{ url('/admin/bower_components/chosen/chosen.jquery.js') }}"></script>
<script src="{{ url('/admin/bower_components/chosen/docsupport/init.js') }}"></script>
</body>
</html>
