<p <?php echo get_block_wrapper_attributes(); ?>>
<div id="staff-block-vanilla" style="overflow: hidden; max-width: 100%!important">

  <script>
  // Get each staff member created on the WP dashboard with the REST API and parse the data into a usable array
  const staff = JSON.parse( httpGet(window.location.origin + '/wp-json/wp/v2/br_person') );

  // Sort each staff member so that they are ordered to appear on the page alphabetically by the slug
  staff.sort(function(a, b){
    if(a.slug < b.slug) { return -1; }
    if(a.slug > b.slug) { return 1; }
      return 0;
    });

  let theCode = '';

  // generate the code for each of the rows using the data retrieved for each staff member
  if ( staff.length != 0 ) {
  staff.forEach(element => theCode += createRow(element));
  } else {
    theCode = '<p>No staff members to show.  Please fill out staff members on the WP dashboard to populate this page.</p>';
  }

  // Add the resulting code to the block
  const block = document.getElementById('staff-block-vanilla');
  block.innerHTML = theCode;

// function to generate a row to display in the block for each staff member
function createRow(item) {
  let thePermalink = item.link;
  let theName = item.cmb2.custom_fields.br_name;
  let theBio = item.cmb2.custom_fields.br_bio;
  let thePortrait = item.cmb2.custom_fields.br_portrait;
  let theTitle = item.cmb2.custom_fields.br_title;

  let theRow = `<div class="staff-member-div">
							<a href="` + thePermalink + `">
								<div>
									<img class="staff-portrait" src="` + thePortrait + `" />
									<br />
									<p class="title-text" ">` + theTitle + `</p>
								</div>
							</a>

				<div>
						<div class="name-text"><b>` + theName + `</b></div>
						<div class="bio-text">` + theBio + `</div>
				</div>

				</div>`;

  return theRow;
}

  // function to retrieve data from the WordPress REST API
  function httpGet(theUrl) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
  }
</script>

</div>
</p>
