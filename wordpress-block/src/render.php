<p <?php echo get_block_wrapper_attributes(); ?>>

<script>
  function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
</script>
<div id="timer">
  <script>
  let staff = JSON.parse( httpGet('http://dev.local/wp-json/wp/v2/br_person') );
  staff.forEach(element => console.log(element));

</script>
</div>
</p>
