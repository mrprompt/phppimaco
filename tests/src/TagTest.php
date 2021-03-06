<?php
namespace PhpPimacoTest;

use Proner\PhpPimaco\Tags\Barcode;
use Proner\PhpPimaco\Tags\P;
use Proner\PhpPimaco\Tag;

class TagTest extends \PHPUnit_Framework_TestCase
{
    function test_border()
    {
        $template = "teste.json";
        $path = dirname(__DIR__) . "/templates/";

        $tag = new Tag('teste');
        $tag->loadConfig($template, $path);

        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());

        $tag->setBorder(0.1);
        $render = "<div style='width: 10mm;height: 10mm;border: 0.1mm solid black;'><div style='padding: 0mm;'><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());
    }

    function test_padding()
    {
        $template = "teste.json";
        $path = dirname(__DIR__) . "/templates/";

        $tag = new Tag('teste');
        $tag->loadConfig($template, $path);

        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());

        $tag->setPadding(4);
        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 4mm;'><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());
    }

    function test_render()
    {
        $template = "teste.json";
        $path = dirname(__DIR__) . "/templates/";

        $tag = new Tag('teste');
        $tag->loadConfig($template, $path);

        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());
    }

    function test_render_with_p()
    {
        $template = "teste.json";
        $path = dirname(__DIR__) . "/templates/";

        $tag = new Tag();
        $tag->loadConfig($template, $path);

        $tag->p('teste');
        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());

        $tag->p('teste2');
        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><span>teste</span><span>teste2</span></div></div>";
        $this->assertEquals($render,$tag->render());

        $tag->p('teste3')->b();
        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><span>teste</span><span>teste2</span><span style='font-weight: bold;'>teste3</span></div></div>";
        $this->assertEquals($render,$tag->render());
    }

    function test_render_add_p()
    {
        $template = "teste.json";
        $path = dirname(__DIR__) . "/templates/";

        $tag = new Tag();
        $tag->loadConfig($template, $path);

        $p = new P('teste');
        $tag->addP($p);
        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());

        $p = new P('teste3');
        $tag->addP($p)->b();
        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><span>teste</span><span style='font-weight: bold;'>teste3</span></div></div>";
        $this->assertEquals($render,$tag->render());
    }

    function test_render_with_barcode()
    {
        $template = "teste.json";
        $path = dirname(__DIR__) . "/templates/";

        $tag = new Tag();
        $tag->loadConfig($template, $path);

        $tag->barcode('123456789');
        $tag->p('teste');

        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><img style='float: left' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMoAAAAeAQMAAABXBBPSAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAC1JREFUKJFj+Mx/2Maeh+eDPbPNB57D9ufPH7YxsD/zwd74AMOo1KjUqBRMCgBS6GBUqpqy9wAAAABJRU5ErkJggg=='><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());
    }

    function test_render_add_barcode()
    {
        $template = "teste.json";
        $path = dirname(__DIR__) . "/templates/";

        $barcode = new Barcode('123456789');

        $tag = new Tag();
        $tag->loadConfig($template, $path);

        $tag->addBarcode($barcode);
        $tag->p('teste');

        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><img style='float: left' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMoAAAAeAQMAAABXBBPSAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAC1JREFUKJFj+Mx/2Maeh+eDPbPNB57D9ufPH7YxsD/zwd74AMOo1KjUqBRMCgBS6GBUqpqy9wAAAABJRU5ErkJggg=='><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());
    }

    function test_render_with_img()
    {
        $template = "teste.json";
        $path = dirname(__DIR__) . "/templates/";

        $tag = new Tag();
        $tag->loadConfig($template, $path);

        $tag->img('tests/teste.png');
        $tag->p('teste');

        $render = "<div style='width: 10mm;height: 10mm;'><div style='padding: 0mm;'><img style='float: left' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAAAmCAYAAAB0xJ2ZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH4AoLEjsb7lR/SAAAAB1pVFh0Q29tbWVudAAAAAAAQ3JlYXRlZCB3aXRoIEdJTVBkLmUHAAACW0lEQVRo3u2Zv0tyURjHv/fllbo2JAki2qgUuBbiILgIgZs6ufgXBNFQW0R7a0NCU1NzQkgQIgg6tTZEUy5CIMWtoPq8U5d+vL56oy68eB44y32e83zv/ZznPHDOtQA0wfZLE24GgAFgABgABoABYAAYAAbApNrvcYIsy/KU9LuOF6+6P3lcMRXw1RX1Y3X+2x5weHioXC6nUCikqakpJRIJbWxsaDAYuDH39/fa2trS4uKiZmZmNDs7q3w+r+Pj40/bzrIsd3jVGWd1v2SS+Dj95eWFSqXi+j6OVCrFYDAAoFqtDo17m/9vPi86I7/jOwHUajUkMT8/z9HREf1+H8dxaLfbLC8vI4nNzU0AQqEQktjd3eXm5obHx0c6nQ7FYvGfGl51fAWQTqeRRKvV+hR/eXmJJJLJJADJZBJJFAoFtre3aTabPD8/j9TwquMrgGAwOLQsX0cgEADg9PSUSCTyzpdIJDg/Px8JwIuOrwBs2x75Ym/nOI5DvV5nbW2NWCyGJLLZ7EgAXnV8A7C0tIQkut2u53y9Xg9JBINB95llWUji6enp23R+FMDBwQGSiEaj1Go1rq6ucByHh4cHLi4u2N/fJ5PJALCyskKj0eDu7o7b21v29vaQxPT0tJsvHA4jiZOTk3f9wYuOrwAAVldXxyrNYb5KpeLmKpfLQ8t6XB3fAbw2uHK5TDweJxAIYNs2qVSK9fV1t8mdnZ1RKpUIh8PYts3CwgI7Ozs4juPmub6+plQqMTc3524HrzqjzDI/Rsx9gAFgABgABoABYAAYAAaAAWAATKL9AZmQ1w5fH521AAAAAElFTkSuQmCC'><span>teste</span></div></div>";
        $this->assertEquals($render,$tag->render());
    }
}