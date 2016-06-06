<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 8:19 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Services;


use Vinlock\StreamAPI\Stream;
use Vinlock\StreamAPI\StreamDriver;

class Service {

    protected $streams;

    protected static $service = NULL;

    public function __construct(array $streams) {
        $this->streams = $streams;
    }

    protected function service_construct($array) {
        $usernames = [];
        foreach ($array as $param) {
            if (is_array($param)) {
                $usernames = $param;
            } elseif (is_string($param)) {
                array_push($usernames, $param);
            }
        }
        return StreamDriver::getStreams($usernames, static::$service);
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

    public function getJSON(bool $pretty=FALSE) {
        return json_encode($this->getArray(), ($pretty) ? JSON_PRETTY_PRINT : NULL);
    }

    public function getObject() {
        return (object) $this->getArray();
    }

    public function sort($sort=NULL) {
        $sort = ($sort == NULL) ? $this->streams : $sort;
        usort($sort, function($a, $b) {
            return $b->viewers() <=> $a->viewers();
        });
    }

    public static function merge($arr = NULL) {
        if (!is_array($arr)) {
            $arr = func_get_args();
        }
        $array = [];
        foreach ($arr as $param) {
            foreach ($param->get() as $obj) {
                array_push($array, $obj);
            }
        }
        usort($array, function($a, $b) {
            return $b->viewers() <=> $a->viewers();
        });
        return new Service($array);
    }

    public static function game() {
        $all_streams = [];
        foreach (func_get_args() as $param) {
            if (is_array($param)) {
                foreach ($param as $game) {
                    $all_streams = array_merge($all_streams, StreamDriver::byGame($game, static::$service));
                }
            } elseif (is_string($param)) {
                $all_streams = array_merge($all_streams, StreamDriver::byGame($param, static::$service));
            }
        }
        $streams = new Service($all_streams);
        $streams->sort();
        return $streams;
    }

    public function cut(int $num=10) {
        $this->streams = array_slice($this->streams, 0, $num);
    }

    public function prepend(Service $service) {
        $this->streams = array_push($service->streams, $this->streams);
    }

}
