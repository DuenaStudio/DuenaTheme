
(function() {

   tinymce.create('tinymce.plugins.bootstraptypo', {
      init : function(ed, url) {
         ed.addButton('bootstraptypo', {
          image:url + 'bootstrap-icon.png'
         });
      },
      createControl: function(n, cm) {

         switch (n) {
            case 'bootstraptypo':
               var t = this, c, ed = t.editor;
                c = cm.createSplitButton(n, {title : 'Progress Bars'});

                c.onRenderMenu.add(function(c, m) {
                    m.add({title : 'Progress Bars', 'class' : 'mceMenuItemTitle'}).setDisabled(1);

                    m.add({title : 'Basic', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Basic Striped', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-striped"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-striped"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Basic Animated', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-striped active"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-striped active"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Success', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-success"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-success"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Success Striped', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-success progress-striped"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-success progress-striped"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Success Animated', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-success progress-striped active"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-success progress-striped active"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Danger', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-danger"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-danger"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Danger Striped', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-danger progress-striped"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-danger progress-striped"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Danger Animated', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress bar fill level (in %)", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-danger progress-striped active"><span class="bar" style="width: ' + text + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress progress-danger progress-striped active"><span class="bar" style="width: 50%;">&nbsp;</span></div><br>');
                        }
                    }});

                    m.add({title : 'Mixed', onclick : function() {
                        var t = this, c, ed = t.editor;
                        var text = prompt("Progress Bar Part 1 Width", "50");
                        var text1 = prompt("Progress Bar Part 2 Width", "50");
                        var text2 = prompt("Progress Bar Part 3 Width", "50");

                        if (text != null && text != ''){
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress"><span class="bar" style="width: ' + text + '%;">&nbsp;</span><span class="bar bar-success" style="width: ' + text1 + '%;">&nbsp;</span><span class="bar bar-danger" style="width: ' + text2 + '%;">&nbsp;</span></div><br>');
                        }
                        else{
                              tinyMCE.execCommand('mceInsertContent', false, '<div class="progress"><span class="bar" style="width: 33%;">&nbsp;</span></div><span class="bar bar-success" style="width: 34%;">&nbsp;</span></div><span class="bar bar-danger" style="width: 33%;">&nbsp;</span></div><br>');
                        }
                    }});
              });

              // Return the new menubutton instance
              return c;
        }
        return null;
    }
   });
   tinymce.PluginManager.add('bootstraptypo', tinymce.plugins.bootstraptypo);
})();