import { useState } from "react"

const FormRegister = () => {
  const [form, setForm] = useState<any>(null)

  const handleSubmitForm = (e: any) => {
    e.preventDefault();

    console.log({ form })
  }
  return (
    <form onSubmit={handleSubmitForm}>
      <input type="text" placeholder="email" value={form?.email} onChange={(e: any) => setForm({
        email: e.target.value })}/>
      <br/>
      <input type="text" placeholder="address" value={form?.address} onChange={(e: any) => setForm({
        address: e.target.value })}/>
      <br/>
      <br/>
      <input type="submit" value="Submit" />
    </form>
  )
}

export default FormRegister