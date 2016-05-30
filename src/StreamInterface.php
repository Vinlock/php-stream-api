<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 5:29 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI;


interface StreamInterface {

    /**
     * Stream Username
     *
     * @return string
     */
    function username();

    /**
     * Stream Display Name
     *
     * @return string
     */
    function display_name();

    /**
     * Stream Game
     *
     * @return string
     */
    function game();

    /**
     * URL to Large Stream Preview
     *
     * @return string
     */
    function largePreview();

    /**
     * URL to Medium Stream Preview
     *
     * @return string
     */
    function mediumPreview();

    /**
     * URL to Small Stream Preview
     *
     * @return string
     */
    function smallPreview();

    /**
     * Stream Status
     *
     * @return string
     */
    function status();

    /**
     * Stream URL
     *
     * @return string
     */
    function url();

    /**
     * Stream Viewers
     *
     * @return integer
     */
    function viewers();

    /**
     * Stream ID
     *
     * @return string
     */
    function id();

    /**
     * Stream Avatar URL
     *
     * @return string
     */
    function avatar();

    /**
     * Stream Bio
     *
     * @return mixed
     */
    function bio();

    function created_at();

    function updated_at();

    function followers();

}