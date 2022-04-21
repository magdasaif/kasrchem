                    <!--=======================searchand form ============================-->

  <div class="col-md-6" style="margin-top:40px">
    <div class="form-group" style="border: 3px solid;color: azure;">
    <!-- <input type="text" class="form-control" name="query_text"     onkeyup="search_func(this.value);" placeholder=" بحث باسم القسم ....."   value="{{ request()->input('query_text') }}"> -->
    <input type="text" class="form-control" name="query_text"   id="serach"   placeholder=" بحث   ....."   value="{{ request()->input('query_text') }}">
    </div>
  </div>
  <br> 
  <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
 
   <!--===========================================================================-->