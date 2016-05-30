<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 8:19 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Services;


use Vinlock\StreamAPI\Stream;

class Service {

    protected $streams;

    public function __construct($streams) {
        $this->streams = $streams;
    }

    public function where($value, $key='username') {
        foreach ($this->streams as &$arr) {
            if ($arr->$key == $value) {
                $item =& $arr;
                return $item;
            }
        }
    }

    public function get() {
        return $this->streams;
    }

    public function getArray() {
        $streams = [];

        /** @var \Vinlock\StreamAPI\StreamObjects\Stream $stream */
        foreach ($this->streams as $stream) {
            array_push($streams, $stream->get());
        }

        return $streams;
    }

    public function getJSON($pretty=FALSE) {
        return json_encode($this->getArray(), ($pretty) ? JSON_PRETTY_PRINT : NULL);
    }

    public function getObject() {
        return (object) $this->getArray();
    }

    public static function sortViewers(&$streams) {
        usort($streams, function($a, $b) {
            return $b->viewers - $a->viewers;
        });
    }

    public function sort() {
        usort($this->streams, function($a, $b) {
            return $b->viewers - $a->viewers;
        });
    }

    public static function merge() {
        $array = [];
        foreach (func_get_args() as $param) {
            foreach ($param->get() as $obj) {
                array_push($array, $obj);
            }
        }
        usort($array, function($a, $b) {
            return $b->viewers - $a->viewers;
        });
        return new Service($array);
    }

    public function cut($num=10) {
        return new Service(array_slice($this->streams, 0, $num));
    }

}
