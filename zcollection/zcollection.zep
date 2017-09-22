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
}
