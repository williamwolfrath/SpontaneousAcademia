/**
 *  Copyright (c) 2010 Alethia Inc,
 *  http://www.alethia-inc.com
 *  Developed by Travis Tidwell | travist at alethia-inc.com 
 *
 *  License:  GPL version 3.
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *  
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.

 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */
(function(a){jQuery.media=jQuery.media?jQuery.media:{};jQuery.media.defaults=jQuery.extend(jQuery.media.defaults,{protocol:"auto",server:"drupal",template:"default",baseURL:"",debug:false,draggable:false,resizable:false,showPlaylist:true,autoNext:true,prefix:""});jQuery.media.ids=jQuery.extend(jQuery.media.ids,{loading:".mediaplayerloading",player:".mediaplayer",menu:".mediamenu",titleBar:".mediatitlebar",node:".medianode",playlist:".mediaplaylist"});jQuery.media.players={};jQuery.media.playlists={};jQuery.media.controllers={};jQuery.media.addController=function(b,d){if(d&&d.node&&d.node.player&&d.node.player.controller){var c=jQuery.media.players[b];if(c&&c.node&&c.node.player){c.node.player.addController(d.node.player.controller);}else{if(!jQuery.media.controllers[b]){jQuery.media.controllers[b]=[];}jQuery.media.controllers[b].push(d.node.player.controller);}}};jQuery.media.addPlaylist=function(b,d){if(d&&d.playlist){var c=jQuery.media.players[b];if(c){c.addPlaylist(d.playlist);}else{if(!jQuery.media.playlists[b]){jQuery.media.playlists[b]=[];}jQuery.media.playlists[b].push(d.playlist);}}};jQuery.fn.mediaplayer=function(b){if(this.length===0){return null;}return new (function(d,e){e=jQuery.media.utils.getSettings(e);if(!e.id){e.id=jQuery.media.utils.getId(d);}this.dialog=d;this.display=this.dialog.find(e.ids.player);var g=this;jQuery.media.players[e.id]=this;e.template=jQuery.media.templates[e.template](this,e);e=jQuery.extend(e,e.template.getSettings());if(jQuery.media[e.protocol]){this.protocol=jQuery.media[e.protocol](e);}if(jQuery.media[e.server]){this.server=jQuery.media[e.server](this.protocol,e);}this.width=this.dialog.width();this.height=this.dialog.height();this.menu=this.display.find(e.ids.menu).mediamenu(this.server,e);if(this.menu){this.menu.display.bind("menuclose",function(){g.showMenu(false);});}this.menuOn=false;this.maxOn=!e.showPlaylist;this.fullScreen=false;this.playlist=null;this.activePlaylist=null;this.showMenu=function(h){if(e.template.onMenu){this.menuOn=h;e.template.onMenu(this.menuOn,true);}};this.titleBar=this.dialog.find(e.ids.titleBar).mediatitlebar(e);if(this.titleBar){this.titleBar.display.bind("menu",function(h){g.showMenu(!g.menuOn);});this.titleBar.display.bind("maximize",function(h){g.maximize(!g.maxOn);});this.titleBar.display.bind("fullscreen",function(h){g.fullScreen=!g.fullScreen;if(g.node&&g.node.player){g.node.player.fullScreen(g.fullScreen);}});if(e.draggable&&this.dialog.draggable){this.dialog.draggable({handle:e.ids.titleBar,containment:"document"});}if(e.resizable&&this.dialog.resizable){this.dialog.resizable({alsoResize:this.display,containment:"document",resize:function(h){g.setSize(g.dialog.width(),g.dialog.height());}});}}this.node=this.display.find(e.ids.node).medianode(this.server,e);if(this.node){this.node.display.bind("nodeload",function(h,i){g.onNodeLoad(i);});if(this.node.player){this.node.player.display.bind("mediaupdate",function(h,i){g.onMediaUpdate(i);});}if(this.node.uservoter){this.node.uservoter.display.bind("voteSet",function(i,h){if(g.activePlaylist){g.activePlaylist.onVoteSet(h);}});}}this.onMediaUpdate=function(h){if(e.autoNext&&this.activePlaylist&&(h.type=="complete")){this.activePlaylist.pager.loadNext(true);}if(this.menu&&this.node&&(h.type=="meta")){this.menu.setEmbedCode(this.node.player.media.player.getEmbedCode());this.menu.setMediaLink(this.node.player.media.player.getMediaLink());}};this.onPlaylistLoad=function(h){if(this.node){this.node.loadNode(h);}if(e.template.onPlaylistLoad){e.template.onPlaylistLoad(h);}};this.onNodeLoad=function(h){if(e.template.onNodeLoad){e.template.onNodeLoad(h);}};this.onResize=function(i,h){if(e.template.onResize){e.template.onResize(i,h);}if(this.playlist){this.playlist.onResize(i,h);}if(this.node){this.node.onResize(i,h);}};this.maximize=function(h){if(!this.fullScreen){if(e.template.onMaximize&&(h!=this.maxOn)){this.maxOn=h;e.template.onMaximize(this.maxOn);}}};this.addPlaylist=function(h){if(h){h.display.bind("playlistload",h,function(i,j){g.activePlaylist=i.data;g.onPlaylistLoad(j);});if(!this.activePlaylist&&h.activeTeaser){this.activePlaylist=h;this.onPlaylistLoad(h.activeTeaser.node.nodeInfo);}}return h;};this.playlist=this.addPlaylist(this.display.find(e.ids.playlist).mediaplaylist(this.server,e));if(jQuery.media.playlists&&jQuery.media.playlists[e.id]){var f=jQuery.media.playlists[e.id];var c=f.length;while(c--){this.addPlaylist(f[c]);}}this.setSize=function(k,j){k=k?k:this.width;j=j?j:this.height;if((k!=this.width)||(j!=this.height)){var i=(k-this.width);var h=(j-this.height);this.width=k;this.height=j;this.dialog.css({width:this.width,height:this.height});this.onResize(i,h);}};this.loadContent=function(){if(this.playlist){this.playlist.loadPlaylist();}if(this.node){this.node.loadNode();}};this.load=function(){if(e.template.initialize){e.template.initialize(e);}this.onResize(0,0);this.dialog.css("position","relative");this.dialog.css("marginLeft",0);this.dialog.css("overflow","visible");this.server.connect(function(h){g.loadContent();});};this.load();})(this,b);};})(jQuery);