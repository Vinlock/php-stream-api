<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 5:29 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Services;



use Vinlock\StreamAPI\StreamDriver;
use Vinlock\StreamAPI\StreamObjects\Stream;

class Twitch extends Service {

    function __construct() {
        $array = func_get_args();
        $usernames = [];
        foreach ($array as $param) {
            if (is_array($param)) {
                $usernames = $param;
            } elseif (is_string($param)) {
                array_push($usernames, $param);
            }
        }
        $this->streams = StreamDriver::getStream($usernames, 'twitch');
    }

    public static function game() {
        $limit = StreamDriver::NUM_PER_MULTI;
        $all_streams = [];
        foreach (func_get_args() as $param) {
            if (is_int($param)) {
                $limit = $param;
            } elseif (is_string($param)) {
                $all_streams = array_merge($all_streams, StreamDriver::byGame($param, 'twitch', $limit));
            }
        }
        $streams = new Service($all_streams);
        $streams->sort();
        return $streams;
    }

}