(()=>{"use strict";var e,t={561:()=>{const e=window.wp.blocks,t=window.wp.element,l=window.wp.blockEditor,r=window.wp.components,n=JSON.parse('{"u2":"brothman01/team-page-block"}');(0,e.registerBlockType)(n.u2,{edit:function(e){let{attributes:n,setAttributes:o}=e;const a=(0,l.useBlockProps)();return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(l.InspectorControls,null,(0,t.createElement)(r.PanelBody,{title:"Block Settings",initialOpen:!1},(0,t.createElement)(r.PanelRow,null,(0,t.createElement)(r.TextControl,{label:"Staff ID (leave blank for all)",onChange:e=>o({list_id:e}),value:n.list_id})))),(0,t.createElement)("div",a,(0,t.createElement)("span",null,"Team Block")))}})}},l={};function r(e){var n=l[e];if(void 0!==n)return n.exports;var o=l[e]={exports:{}};return t[e](o,o.exports,r),o.exports}r.m=t,e=[],r.O=(t,l,n,o)=>{if(!l){var a=1/0;for(p=0;p<e.length;p++){for(var[l,n,o]=e[p],i=!0,s=0;s<l.length;s++)(!1&o||a>=o)&&Object.keys(r.O).every((e=>r.O[e](l[s])))?l.splice(s--,1):(i=!1,o<a&&(a=o));if(i){e.splice(p--,1);var c=n();void 0!==c&&(t=c)}}return t}o=o||0;for(var p=e.length;p>0&&e[p-1][2]>o;p--)e[p]=e[p-1];e[p]=[l,n,o]},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={189:0,307:0};r.O.j=t=>0===e[t];var t=(t,l)=>{var n,o,[a,i,s]=l,c=0;if(a.some((t=>0!==e[t]))){for(n in i)r.o(i,n)&&(r.m[n]=i[n]);if(s)var p=s(r)}for(t&&t(l);c<a.length;c++)o=a[c],r.o(e,o)&&e[o]&&e[o][0](),e[o]=0;return r.O(p)},l=globalThis.webpackChunkteam_page_block=globalThis.webpackChunkteam_page_block||[];l.forEach(t.bind(null,0)),l.push=t.bind(null,l.push.bind(l))})();var n=r.O(void 0,[307],(()=>r(561)));n=r.O(n)})();