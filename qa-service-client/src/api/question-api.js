const url = __myapp.env.API_URL;

export async function loadList(status, u) {
  const headers = u?.access_token
    ? { headers: { Authorization: "Bearer " + u.access_token } }
    : {};
  console.log({
    method: "get",
    ...headers,
  });
  const res = await fetch(url + "questions/" + status, {
    method: "get",
    ...headers,
  });
  console.log(res);
  const list = await res.json();
  return list;
}

export async function sendQuestion(questionInfo, u) {
  const res = await fetch(url + "questions/create", {
    method: "post",
    headers: {
      Authorization: "Bearer " + u.access_token,
      "Content-Type": "application/json",
    },
    body: JSON.stringify(questionInfo),
  });
  const message = await res.json();
  return message;
}

export async function sendAnswer(questionAnswer, u) {
  const res = await fetch(url + "questions/answer", {
    method: "post",
    headers: {
      Authorization: "Bearer " + u.access_token,
      "Content-Type": "application/json",
    },
    body: JSON.stringify(questionAnswer),
  });
  console.log(await res.json());
}

export async function denyQuestion(questionDenied, u) {
  const res = await fetch(url + "questions/deny", {
    method: "post",
    headers: {
      Authorization: "Bearer " + u.access_token,
      "Content-Type": "application/json",
    },
    body: JSON.stringify(questionDenied),
  });
  console.log(await res.json());
}
