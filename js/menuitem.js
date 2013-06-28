(function() {
   tinymce.create('tinymce.plugins.menuitem', {
      init : function(ed, url) {
         ed.addButton('menuitem', {
            title : 'Menu Item',
            image : url+'/menuitembutton.png',
            onclick : function() {
               var name = prompt("Item Name", "Enter menu item name");
               var desc = prompt("Item Description", "Enter menu item description");
               var price = prompt("Item Price", "Enter menu item price");

			   if ((name != null && name != '')
					&& (desc != null && desc != '')
					&& (price != null && price != '')) {
				   ed.execCommand('mceInsertContent', false, '[menuitem name="'+name+'" desc="'+desc+'" price="'+price+'"]');
			   }
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Recent Posts",
            author : 'Konstantinos Kouratoras',
            authorurl : 'http://www.kouratoras.gr',
            infourl : 'http://wp.smashingmagazine.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('menuitem', tinymce.plugins.menuitem);
})();