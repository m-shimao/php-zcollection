namespace Zcollection;

class Zcollection
{

    protected it;

    public function __construct(array it)
    {
        let this->it = it;
    }

    public function toArray()
    {
        return this->it;
    }

    public function map(var callback)
    {
        array results;
        var key, value;

        let results = [];
        for key, value in this->it {
            let results[key] = {callback}(value);
        }
        let this->it = results;
        return this;
    }

    public function arrayMap(var callback)
    {
        let this->it = array_map(callback, this->it);
        return this;
    }

    public function calcMap()
    {
        array results;
        var key, value;

        let results = [];
        for key, value in this->it {
            let results[key] = intval((value * value * value) / 5) % 12345;
        }
        let this->it = results;
        return this;
    }

    public static function h(string str)
    {
        return htmlspecialchars(str);
    }
}
