
    <script>

        data = [<?php echo file_get_contents(base_path('resources/crud-generator/menus.json')) ?>]
        data = data[0];
        $(function() {
           // alert('Here')
            working = {"menus":[{"section":"Resources","items":[]},{"section":"Tools","items":[{"title":"Generator","url":"\/crud"}]}]}

            var mennu = data.menus[1]['items']

            num = mennu.length;

            for (i = 0; i < num; i++) {

                var title = mennu[i]['title']
                var lurl = mennu[i]['url']
                //var def_menu = document.getElementById('adm_mnu').innerHTML; //.valueOf();

                var mn_el = $('#adm_mnu div:first')
                var cur_menu = mn_el.html();

                var mn_itm  = '<div class="dropdown-divider"></div>' +
                    '<a class="dropdown-item " href="'+lurl+'">' +
                    '' + title + '' +
                    '</a>';

                var all_menu = cur_menu + mn_itm;
                mn_el.html(all_menu);

            }
        });




    </script>



