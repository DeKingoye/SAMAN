!function(t,e,o,n){"use strict";var i=t(".cbp-slider");i.length?(i.find(".cbp-slider-item").addClass("cbp-item"),i.cubeportfolio({layoutMode:"slider",mediaQueries:[{width:1,cols:1}],gapHorizontal:0,gapVertical:0,caption:"",coverRatio:""})):t("<div/>").cubeportfolio(),{content:t(".cbp-popup-singlePage"),checkForSocialLinks:function(){var t=this;t.createFacebookShare(this.content.find(".cbp-social-fb")),t.createTwitterShare(this.content.find(".cbp-social-twitter")),t.createGooglePlusShare(this.content.find(".cbp-social-googleplus")),t.createPinterestShare(this.content.find(".cbp-social-pinterest"))},createFacebookShare:function(t){t.length&&!t.attr("onclick")&&t.attr("onclick","window.open('http://www.facebook.com/sharer.php?u="+encodeURIComponent(e.location.href)+"', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;")},createTwitterShare:function(t){t.length&&!t.attr("onclick")&&t.attr("onclick","window.open('https://twitter.com/intent/tweet?source="+encodeURIComponent(e.location.href)+"&text="+encodeURIComponent(o.title)+"', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=300'); return false;")},createGooglePlusShare:function(t){t.length&&!t.attr("onclick")&&t.attr("onclick","window.open('https://plus.google.com/share?url="+encodeURIComponent(e.location.href)+"', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=450'); return false;")},createPinterestShare:function(t){if(t.length&&!t.attr("onclick")){var o="",n=this.content.find("img")[0];n&&(o=n.src),t.attr("onclick","window.open('http://pinterest.com/pin/create/button/?url="+encodeURIComponent(e.location.href)+"&media="+o+"', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;")}}}.checkForSocialLinks()}(jQuery,window,document);