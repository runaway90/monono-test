import Axios from 'axios';
const httpClient = Axios.create({
    baseURL: `${window.location.protocol}//${window.location.hostname}/`,
    headers: {
        'api-connect': 'active',
        'Content-Type': 'application/json',
    },
});
export default httpClient;