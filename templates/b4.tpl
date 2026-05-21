<{if $smarty.session.bootstrap==4}>
    <{include file="$xoops_rootpath/modules/$xoops_dirname/templates/b4/`$this_file`"}>
<{else}>
    <{include file="$xoops_rootpath/modules/$xoops_dirname/templates/b3/`$this_file`"}>
<{/if}>
