import axios from "axios/index";
import qs from "qs";

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const client = ({url, method, ...args}) => {
  if (method === "GET") {
    let extra = args.data ? "?" + qs.stringify(args.data) : '';
    return axios.get(url + extra);
  }
  return axios({
    url: url,
    method: method,
    data: qs.stringify(args.data),
  });
};

// Add a response interceptor
axios.interceptors.response.use(
  response => {
    // Do something with response data
    return response;
  },
  error => {
    if (error.response) {
      // The request was made and the server responded with a status code
      // that falls out of the range of 2xx
      //server error
      if (error.response.status === 500) {
        if (error.response.data && error.response.data.message) {
          bus.$emit('error-alert', error.response.data.message);
        } else {
          bus.$emit('error-alert', '500 Error');
        }
      }
    } else if (error.request) {
      // The request was made but no response was received
      // `error.request` is an instance of XMLHttpRequest
      bus.$emit('error-alert', 'No response from server');
    } else {
      // Something happened in setting up the request that triggered an Error
      bus.$emit('error-alert', 'Unknown Error');
    }
    // Do something with response error
    return Promise.reject(error);
  }
);
export default client;
