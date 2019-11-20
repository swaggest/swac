// Code generated by github.com/swaggest/swac v0.1.5, DO NOT EDIT.

package petstore

import (
	"net/http"
)

type responseError struct {
	resp *http.Response
	body []byte
	err  error
}

func (re responseError) Unwrap() error {
	return re.err
}

func (re responseError) Error() string {
	return re.err.Error()
}

func (re responseError) ResponseBody() []byte {
	return re.body
}

func (re responseError) Response() *http.Response {
	return re.resp
}
