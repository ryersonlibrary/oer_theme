tinymce.PluginManager.add("apply_class",function(s){function t(){var t=s.selection.getNode(),a=s.selection.getContent();s.windowManager.open({title:s.getLang("strings.applyclass"),body:{type:"textbox",name:"class",size:40,label:s.getLang("strings.classtitle")},onsubmit:function(n){""!==a?s.selection.setContent('<span class="'+n.data["class"]+'">'+a+"</span>"):s.dom.addClass(t,n.data["class"])}})}s.addButton("apply_class",{icon:"icon dashicons-art",tooltip:s.getLang("strings.applyclass"),onclick:t}),s.addMenuItem("apply_class",{icon:"icon dashicons-art",text:s.getLang("strings.applyclass"),context:"insert",onclick:t})});