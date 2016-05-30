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

    const STREAM_KEY = "streams";

    const STREAM_API = "https://api.twitch.tv/kraken/streams?channel=";

    const GAMES_API = "https://api.twitch.tv/kraken/streams?game=";

    const USERS_API = "https://api.twitch.tv/kraken/users/";

    const STREAM_URL = "http://www.twitch.tv/";

    const DEFAULT_AVATAR = "http://static-cdn.jtvnw.net/jtv_user_pictures/xarth/404_user_150x150.png";

    public function __construct($array) {

    }

    /**
     * Stream Username
     *
     * @return string
     */
    public function username() {
        // TODO: Implement username() method.
    }

    /**
     * Stream Display Name
     *
     * @return string
     */
    public function displayName() {
        // TODO: Implement displayName() method.
    }

    /**
     * Stream Game
     *
     * @return string
     */
    public function game() {
        // TODO: Implement game() method.
    }

    /**
     * URL to Large Stream Preview
     *
     * @return string
     */
    public function largePreview() {
        // TODO: Implement largePreview() method.
    }

    /**
     * URL to Medium Stream Preview
     *
     * @return string
     */
    public function mediumPreview() {
        // TODO: Implement mediumPreview() method.
    }

    /**
     * URL to Small Stream Preview
     *
     * @return string
     */
    public function smallPreview() {
        // TODO: Implement smallPreview() method.
    }

    /**
     * Stream Status
     *
     * @return string
     */
    public function status() {
        // TODO: Implement status() method.
    }

    /**
     * Stream URL
     *
     * @return string
     */
    public function url() {
        // TODO: Implement url() method.
    }

    /**
     * Stream Viewers
     *
     * @return integer
     */
    public function viewers() {
        // TODO: Implement viewers() method.
    }

    /**
     * Stream ID
     *
     * @return string
     */
    public function id() {
        // TODO: Implement id() method.
    }

    /**
     * Stream Avatar URL
     *
     * @return string
     */
    public function avatar() {
        // TODO: Implement avatar() method.
    }


}