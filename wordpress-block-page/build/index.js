!function(){"use strict";var e,t={960:function(e,t,n){var r=window.React,l=n.n(r),o=window.wp.blocks,a=window.ReactDOM,s=n.n(a),c=window.wp.blockEditor,i=window.wp.components,u=JSON.parse('{"u2":"brothman01/team-page-block"}');class f extends l().Component{constructor(e){super(e),this.state={posts:[]}}componentDidMount(){const e=vars.rest_url;fetch(e).then((e=>e.json())).then((e=>this.setState({posts:e})))}createRows=()=>{const{posts:e}=this.state,t=[];return e&&e.length?(e.map(((e,n)=>{t.push(this.createRow(e))})),t):(0,r.createElement)("p",null,"No teammates to show.  Please fill out staff members on the WP dashboard to populate this page.")};createRow(e){let t=e.link,n=e.cmb2.custom_fields.br_name,l=e.cmb2.custom_fields.br_bio,o=e.cmb2.custom_fields.br_portrait,a=e.cmb2.custom_fields.br_title;return(0,r.createElement)("div",{class:"staff-member-div"},(0,r.createElement)("a",{href:t},(0,r.createElement)("div",{style:{float:"left"}},(0,r.createElement)("img",{class:"staff-portrait",src:o}),(0,r.createElement)("br",null),(0,r.createElement)("p",{class:"title-text"},a))),(0,r.createElement)("div",{style:{float:"left"}},(0,r.createElement)("div",{class:"name-text"},(0,r.createElement)("b",null,n)),(0,r.createElement)("div",{class:"bio-text"},l)))}render(){return(0,r.createElement)("div",null,this.createRows())}}var m=f;s().render((0,r.createElement)(m,null),document.getElementById("staff-block-react")),(0,o.registerBlockType)(u.u2,{edit:function({attributes:e,setAttributes:t}){const n=(0,c.useBlockProps)();return(0,r.createElement)(r.Fragment,null,(0,r.createElement)(c.InspectorControls,null,(0,r.createElement)(i.PanelBody,{title:"Block Settings",initialOpen:!1},(0,r.createElement)(i.PanelRow,null,(0,r.createElement)(i.TextControl,{label:"Staff ID (leave blank for all)",onChange:e=>t({list_id:e}),value:e.list_id})))),(0,r.createElement)("div",{...n},(0,r.createElement)("span",null,"Team Block")))}})}},n={};function r(e){var l=n[e];if(void 0!==l)return l.exports;var o=n[e]={exports:{}};return t[e](o,o.exports,r),o.exports}r.m=t,e=[],r.O=function(t,n,l,o){if(!n){var a=1/0;for(u=0;u<e.length;u++){n=e[u][0],l=e[u][1],o=e[u][2];for(var s=!0,c=0;c<n.length;c++)(!1&o||a>=o)&&Object.keys(r.O).every((function(e){return r.O[e](n[c])}))?n.splice(c--,1):(s=!1,o<a&&(a=o));if(s){e.splice(u--,1);var i=l();void 0!==i&&(t=i)}}return t}o=o||0;for(var u=e.length;u>0&&e[u-1][2]>o;u--)e[u]=e[u-1];e[u]=[n,l,o]},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={826:0,307:0};r.O.j=function(t){return 0===e[t]};var t=function(t,n){var l,o,a=n[0],s=n[1],c=n[2],i=0;if(a.some((function(t){return 0!==e[t]}))){for(l in s)r.o(s,l)&&(r.m[l]=s[l]);if(c)var u=c(r)}for(t&&t(n);i<a.length;i++)o=a[i],r.o(e,o)&&e[o]&&e[o][0](),e[o]=0;return r.O(u)},n=self.webpackChunkteam_page_block=self.webpackChunkteam_page_block||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var l=r.O(void 0,[307],(function(){return r(960)}));l=r.O(l)}();