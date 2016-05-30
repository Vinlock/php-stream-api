<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 5:29 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Twitch;


use Vinlock\StreamAPI\Stream;
use Vinlock\StreamAPI\StreamInterface;

class StreamObject extends Stream implements StreamInterface {

    protected $service = 'twitch';

    const STREAM_KEY = "streams";

    const STREAM_API = "https://api.twitch.tv/kraken/streams?channel=";

    const GAMES_API = "https://api.twitch.tv/kraken/streams?game=";

    const USERS_API = "https://api.twitch.tv/kraken/users/";

    const STREAM_URL = "http://www.twitch.tv/";

    const DEFAULT_AVATAR = "http://static-cdn.jtvnw.net/jtv_user_pictures/xarth/404_user_150x150.png";

    public function __construct($array) {
        $this->stream = $array;
    }

    /**
     * Stream Username
     *
     * @return string
     */
    public function username() {
        return $this->stream['channel']['name'];
    }

    /**
     * Stream Display Name
     *
     * @return string
     */
    public function displayName() {
        return $this->stream['channel']['display_name'];
    }

    /**
     * Stream Game
     *
     * @return string
     */
    public function game() {
        return $this->stream['game'];
    }

    /**
     * URL to Large Stream Preview
     *
     * @return string
     */
    public function largePreview() {
        return $this->stream['preview']['large'];
    }

    /**
     * URL to Medium Stream Preview
     *
     * @return string
     */
    public function mediumPreview() {
        return $this->stream['preview']['medium'];
    }

    /**
     * URL to Small Stream Preview
     *
     * @return string
     */
    public function smallPreview() {
        return $this->stream['preview']['small'];
    }

    /**
     * Stream Status
     *
     * @return string
     */
    public function status() {
        return $this->stream['channel']['status'];
    }

    /**
     * Stream URL
     *
     * @return string
     */
    public function url() {
        return $this->stream['channel']['url'];
    }

    /**
     * Stream Viewers
     *
     * @return integer
     */
    public function viewers() {
        return $this->stream['viewers'];
    }

    /**
     * Stream ID
     *
     * @return string
     */
    public function id() {
        return $this->stream['_id'];
    }

    /**
     * Stream Avatar URL
     *
     * @return string
     */
    public function avatar() {
        return $this->stream['channel']['logo'];
    }


}