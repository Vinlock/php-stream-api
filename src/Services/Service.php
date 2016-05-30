<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 8:19 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Services;


use Vinlock\StreamAPI\Stream;

abstract class Service {

    /**
     * @var Stream
     */
    protected $stream;

    public function getJSON() {
        return json_encode($this->finalResult());
    }

    public function getArray() {
        return $this->finalResult();
    }

    public function getObject() {
        return (object) $this->finalResult();
    }

    public function __get(string $var) {
        return $this->stream->$var;
    }

    public function __set(string $var, $value) {
        $this->stream->$var = $value;
    }

    private function finalResult() {
        $info = $this->stream->members();
        $custom_info = $this->stream->customMembers;
        $final = array_merge($info, $custom_info);
        return $final;
    }

}