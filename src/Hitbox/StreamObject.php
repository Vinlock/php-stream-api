<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 7:16 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Hitbox;


use Vinlock\StreamAPI\Stream;
use Vinlock\StreamAPI\StreamInterface;

class StreamObject extends Stream implements StreamInterface {

    const STREAM_KEY = "livestream";

    const STREAM_API = "https://www.hitbox.tv/api/media/live/";

    const GAMES_API = "https://api.hitbox.tv/media/live/list?game=";

    const STREAM_IMG = "http://edge.sf.hitbox.tv";

    const STREAM_URL = "http://www.hitbox.tv/";

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