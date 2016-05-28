<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" type="text/css" href="https://sagecell.sagemath.org/static/sagecell_embed.css">
    <script src="https://sagecell.sagemath.org/static/jquery.min.js"></script>
    <script src="https://sagecell.sagemath.org/static/embedded_sagecell.js"></script>
</head>
<body>
    <script>$(function () {
            // Make *any* div with class 'compute' a Sage cell
            sagecell.makeSagecell({inputLocation: 'div.compute',
                evalButtonText: 'Evaluate',
                autoeval: true,
                template:       sagecell.templates.minimal,
                hide: ["evalButton","permalink","editor"]});
        });
    </script>
    <div style="position:absolute; top: 0; left: 0; background-color: #FFFFFF" id="output">
        <div class="compute">
            <script type="text/x-sage">{!! $script !!}</script>
        </div>
    </div>
</body>
</html>