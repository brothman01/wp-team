import React, { Component } from 'react';

class App extends React.Component {

  constructor( props ) {
    super( props );
    this.state = {
      posts: []
    };
  }

  componentDidMount() {
        // Fetch the data from the URL
        const theUrl = window.location.origin + "/wp-json/wp/v2/br_person?filter[orderby]=date&order=desc&per_page=5&post_status=published";
        fetch(theUrl, {
          method : 'get',
          mode : 'cors',
          headers : {
            'Access-Control-Allow-Origin' : '*',
            'X-WP-Header' : vars._wpnonce
          }
        })
        .then(response => response.json())
        .then(response => // set the posts to the state variable 'posts' in the second then()
          this.setState({
            posts: response,
          })
        )
  }

  createRows = () => {

    // declare the state variable as a constant
    const { posts } = this.state;

    const people = [];

    // check if posts exists and has a non-zero length
    if (posts && posts.length) {
      const items = posts.map( ( post, index ) => {
        people.push(this.createRow(post));
      } );

      return people;

    }

    return <p>No teammates to show.  Please fill out staff members on the WP dashboard to populate this page.</p>

  }

  // function to generate a row to display in the block for each staff member
  createRow(item) {
    let thePermalink = item.link;
    let theName = item.cmb2.custom_fields.br_name;
    let theBio = item.cmb2.custom_fields.br_bio;
    let thePortrait = item.cmb2.custom_fields.br_portrait;
    let theTitle = item.cmb2.custom_fields.br_title;

    // create the row for the post using the data entered into the fields on the dashboard \\
    return <div class="staff-member-div">
      <a href={thePermalink}>
        <div style={{float: "left"}}>
          <img class="staff-portrait" src={thePortrait} />
          <br />
          <p class="title-text">{theTitle}</p>
        </div>
      </a>

      <div style={{float: "left"}}>
        <div class="name-text"><b>{theName}</b></div>
        <div class="bio-text">{theBio}</div>
      </div>

    </div>;
  }

  render() {
    return (
      <div>
        {this.createRows()}
      </div>
    );
  }
}

export default App;